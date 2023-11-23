const mongoose = require('mongoose');

const connectDB = async () => {
    try {
        await mongoose.connect("mongodb://mongo:27017/interview");
        console.log("Connect successfully");
    } catch (err) {
        console.log(err);
    }
}

module.exports = connectDB;