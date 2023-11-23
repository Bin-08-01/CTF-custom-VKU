import requests
from faker import Faker
import json
import time

fake = Faker()
url = "http://localhost:3000/user"
headers = {'Content-Type': 'application/json'}

data = {"idUser": 1, "name": "admin", "email": "admin@example.com", "password": fake.password(), "description": "Chúc mừng bạn đã tìm thấy ghi chú của admin, đây là phần thưởng flag của bạn: VKU{chuc_mung_ban_da_tim_thay_flag_cua_admin}"}
requests.post(url, data=json.dumps(data), headers=headers)

for i in range(2,20):
    data = {"idUser": i, "name": fake.name(), "email": fake.email(), "password": fake.password(), "description": fake.text()}
    requests.post(url, data=json.dumps(data), headers=headers)
    
data = {"idUser": 20, "name": "Sinh viên VKU", "email": "sinhvienVKU@example.com", "password": fake.password(), "description": "Đây là ghi chú của một sinh viên VKU đang tập làm hacker bằng cách hack để đọc ghi chú của thằng admin =)))))"}
requests.post(url, data=json.dumps(data), headers=headers)

for i in range(21, 25):
    data = {"idUser": i, "name": fake.name(), "email": fake.email(), "password": fake.password(), "description": fake.text()}
    requests.post(url, data=json.dumps(data), headers=headers)