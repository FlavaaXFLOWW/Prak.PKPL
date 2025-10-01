const jwt = require('jsonwebtoken');

// Middleware for verifying the JSON Web Token (JWT) sent via the x-auth-token header
module.exports = function(req, res, next) {
    // 1. Get the token from the header 'x-auth-token'
    const token = req.header('x-auth-token');

    // 2. Check if no token is present
    if (!token) {
        // Status 401 means "Unauthorized" (Access denied)
        return res.status(401).json({ msg: 'Akses ditolak, token tidak ditemukan' });
    }

    // 3. Verify the token
    try {
        // Verify the token using the JWT_SECRET from .env
        const decoded = jwt.verify(token, process.env.JWT_SECRET);
        
        // Add the user payload (id and role) to the request object
        // This is crucial for accessing user info in protected routes
        req.user = decoded.user;
        
        // Proceed to the next route handler
        next();
    } catch (err) {
        // If verification fails (e.g., expired or invalid token)
        res.status(401).json({ msg: 'Token tidak valid' });
    }
};
