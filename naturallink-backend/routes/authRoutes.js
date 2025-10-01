const express = require('express');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const User = require('../models/User'); // Pastikan path ke model User benar

const router = express.Router();

// ===================================
// ROUTE 1: REGISTRASI PENGGUNA (POST /api/auth/register)
// ===================================
router.post('/register', async (req, res) => {
    try {
        const { email, password, role } = req.body;
        
        // Validasi input
        if (!email || !password) {
            return res.status(400).json({ msg: 'Mohon masukkan Email dan Password.' });
        }
        
        // Cek apakah user sudah terdaftar
        let user = await User.findOne({ email });
        if (user) {
            return res.status(400).json({ msg: 'Pengguna dengan email ini sudah terdaftar.' });
        }

        // Hash Password
        const salt = await bcrypt.genSalt(10);
        const hashedPassword = await bcrypt.hash(password, salt);

        // Buat dan simpan pengguna baru
        user = new User({
            email,
            password: hashedPassword,
            // Secara default, set role ke 'user' kecuali diminta 'admin'
            role: (role === 'admin') ? 'admin' : 'user'
        });

        await user.save();
        
        res.status(201).json({ 
            msg: 'Registrasi berhasil. Silakan Login.', 
            user: { email: user.email, role: user.role } 
        });

    } catch (err) {
        console.error(err.message);
        res.status(500).send('Server Error pada saat registrasi.');
    }
});


// ===================================
// ROUTE 2: LOGIN PENGGUNA (POST /api/auth/login)
// ===================================
router.post('/login', async (req, res) => {
    try {
        const { email, password } = req.body;

        // Validasi input
        if (!email || !password) {
            return res.status(400).json({ msg: 'Mohon masukkan Email dan Password.' });
        }

        // Cek pengguna berdasarkan email
        const user = await User.findOne({ email });
        if (!user) {
            return res.status(400).json({ msg: 'Email atau Password salah.' });
        }

        // Bandingkan password
        const isMatch = await bcrypt.compare(password, user.password);
        if (!isMatch) {
            return res.status(400).json({ msg: 'Email atau Password salah.' });
        }

        // Buat Payload JWT
        const payload = {
            user: {
                id: user.id, // ID pengguna untuk dicari di route terlindungi
                role: user.role
            }
        };

        // Tandatangani token dan kirim ke pengguna
        jwt.sign(
            payload,
            process.env.JWT_SECRET,
            { expiresIn: '1h' }, // Token berlaku 1 jam
            (err, token) => {
                if (err) throw err;
                res.json({ 
                    token, // Token dikirim ke frontend untuk disimpan di localStorage
                    role: user.role, 
                    msg: `Login Berhasil sebagai ${user.role}` 
                });
            }
        );

    } catch (err) {
        console.error(err.message);
        res.status(500).send('Server Error pada saat login.'); 
    }
});

module.exports = router;
