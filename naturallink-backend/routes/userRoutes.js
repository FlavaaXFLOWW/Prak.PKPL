const express = require('express');
const router = express.Router();
// PATH KRITIS: Ini memanggil middleware/auth.js untuk memverifikasi token
const auth = require('../middleware/auth'); 
const User = require('../models/User'); // Pastikan path ke model User benar

// @route   GET /api/user/me
// @desc    Mendapatkan data user saat ini berdasarkan token yang dikirim
// @access  Private (Rute ini dilindungi dan memerlukan token JWT yang valid)
router.get('/me', auth, async (req, res) => {
    try {
        // req.user.id disetel oleh middleware 'auth' setelah token divalidasi
        // .select('email role -_id') untuk hanya mengambil data yang diperlukan dan menyembunyikan password
        const user = await User.findById(req.user.id).select('email role -_id'); 

        if (!user) {
            // Jika token valid tetapi data user tidak ditemukan di DB
            return res.status(404).json({ msg: 'User not found' });
        }
        
        // Mengirim data pengguna (email dan role) kembali ke frontend
        // Jika ini berhasil (Status 200 OK), frontend akan update tombol navigasi
        res.json(user); 

    } catch (err) {
        console.error('Error in /api/user/me:', err.message);
        // Error server internal
        res.status(500).send('Server Error');
    }
});

module.exports = router;
