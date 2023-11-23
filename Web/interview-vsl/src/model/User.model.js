const mongoose = require("mongoose");

const UserModel = mongoose.Schema({
    idUser: {
        type: Number,
        required: true,
        unique: true
    },

    name: {
        type: String,
        required: true,
        minLength: 1,
    },

    password: {
        type: String,
        required: true,
        minLength: 1,
        trim: true
    },

    email: {
        type: String,
        required: true,
        trim: true
    },

    description: {
        type: String,
    }
}, { timestamps: true });

module.exports = mongoose.model("User", UserModel);