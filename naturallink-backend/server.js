// File: server.js

require('dotenv').config();
const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors'); 

const app = express();
// Gunakan port dari .env atau default ke 5000
const PORT = process.env.PORT || 5000; 

// --- KONEKSI DATABASE ---
mongoose.connect(process.env.MONGO_URI)
    .then(() => console.log('✅ MongoDB berhasil terhubung'))
    .catch(err => console.error('❌ Gagal terhubung ke MongoDB:', err.message));

// --- MIDDLEWARE UTAMA ---
app.use(express.json()); // Wajib untuk parsing body JSON
app.use(cors()); // Izinkan permintaan dari frontend (misalnya di localhost:3000)

// --- ROUTE DASAR (Testing) ---
app.get('/', (req, res) => {
    res.send('Server Naturallink berjalan!');
});

// --- LOAD ROUTES ---
// 1. Route Autentikasi (login, register)
const authRoutes = require('./routes/authRoutes');
app.use('/api/auth', authRoutes);

// 2. Route Pengguna (untuk /api/user/me)
const userRoutes = require('./routes/userRoutes'); 
app.use('/api/user', userRoutes); // Menangani semua request yang diawali /api/user


// --- SERVER LISTEN ---
app.listen(PORT, () => {
    console.log(`🌍 Server berjalan di http://localhost:${PORT}`);
});