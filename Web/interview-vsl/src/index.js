const express = require("express");
const path = require('path');
const UserModel = require("./model/User.model");
const bodyParser = require('body-parser');

const connectDB = require("./connect.db");
connectDB();

const app = express();
app.set('view engine', 'ejs');

app.use(bodyParser.json({
    limit: '50mb'
}));

app.get("/", (req, res) => {
    return res.render(__dirname + "/template/index.ejs");
})

app.get("/users", async (req, res) => {
    try {
        const users = await UserModel.find();
        return res.render(__dirname + "/template/users.ejs", { users });
    } catch (err) {
        return res.status(500).send("500 Server is interupt");
    }
});

app.get("/user/:id", async (req, res) => {
    try {
        const user = await UserModel.findOne({ idUser: req.params.id });
        if (user) {
            return res.render(__dirname + "/template/detail.ejs", { user });
        }
        return res.render(__dirname + "/template/not-found.ejs");
    } catch (error) {
        return res.status(500).send("500 Server is interupt");
    }
});

app.post("/user", async (req, res) => {
    try {
        const user = new UserModel(req.body);
        await user.save();
        return res.redirect("/users");
    } catch (error) {
        console.log(error);
        return res.status(500).send("500 Server is interupt");
    }
});

app.listen(8000, (req, res) => {
    console.log("Server is running on http://localhost:8000");
});