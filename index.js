process.env.NODE_ENV = "production";
require('dotenv').config()
const express = require("express");
const fs = require('fs');
const child = require('child_process');

const app = express();
const PORT = 8080;
const flag = process.env.FLAG || "ctf{flag}"

app.use(express.urlencoded({ extended: true }));
app.enable("trust proxy");
app.set('view engine', 'ejs');

app.post("/register", (req, res) => {
    // 2"); INSERT INTO gemdata VALUES(10000, 2) -- 
    if (req.body.userid && req.body.password && !isNaN(parseInt(req.body.userid)) && parseInt(req.body.userid) > 0) {
        let queryres = execQuery(`INSERT INTO users VALUES(${parseInt(req.body.userid)}, "${req.body.password}"); INSERT INTO gemdata VALUES(${Math.floor(1000 * Math.random())}, ${parseInt(req.body.userid)});`);
        if (queryres === "") {
            res.redirect('/login');
        }
        else {
            res.redirect('https://media.tenor.com/UlIwB2YVcGwAAAAC/waah-waa.gif');
        }
    }
    else {
        res.redirect('https://youtu.be/BsIa_LKojJI');
    }
});

app.get("/register", (req, res) => {
    res.render('register');
});

app.post('/gems', (req, res) => {
    if (req.body.userid && req.body.password) {
        let queryres = execQuery(`SELECT gems FROM users INNER JOIN gemdata ON users.userid = gemdata.userid WHERE users.userid = ${req.body.userid} AND users.password = "${req.body.password}";`);
        if (queryres && !isNaN(parseInt(queryres))) {
            res.render('gems', { gems: queryres, flag: flag });
        }
        else {
            res.redirect('https://media.tenor.com/UlIwB2YVcGwAAAAC/waah-waa.gif');
        }
    }
    else {
        res.redirect('https://youtu.be/BsIa_LKojJI');
    }
})

app.get("/login", (req, res) => {
    res.render('login');
});

app.get("/", (req, res) => {
    res.render('index');
});

app.get("/*", (req, res) => {
    res.redirect('/');
})

app.listen(PORT, () => {
    console.log(`Server listening on port ${PORT}`);
});

/* docker will be doing this step
if (!fs.existsSync('data.db')) {
    child.execSync(`sqlite3 data.db < schema.sql`);
}*/

function sanitize(input) {
    return `${input}`.replace('\n', '').replace('\r', '').replace('--', '');
}

function execQuery(query) {
    fs.writeFileSync('query.txt', sanitize(query));
    //console.log(sanitize(query));
    try {
        let result = child.execSync(`sqlite3 data.db < query.txt`);
        //console.log(result.toString());
        return result.toString().trim();
    }
    catch (err) {
        //console.log(err);
        return undefined;
    }
}
