# Brawl: The Quest for Gems

Leyang has run out of gems to buy new brawlers! He is desperate as flexing on other kids with his 2 trophies in Brawl Stars is his only form of entertainment. Being a broke student, he has tasked you with obtaining gems through unethical means so that he can join the cool kids' club. 

# Hướng dẫn cài đặt

## Cài đặt docker

1. sudo apt-get update
2. sudo apt-get install docker.io
3. sudo systemctl start docker && sudo systemctl enable docker
4. docker --version
5. sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
6. sudo chmod +x /usr/local/bin/docker-compose
7. docker-compose --version

## Cài đặt challenge

1. Mở terminal ở trong thư mục có chứa file docker-compose.yml
2. Chạy lệnh `docker-compose up --build`
3. Mở đường dẫn [http://localhost:8080](http://localhost:8080)