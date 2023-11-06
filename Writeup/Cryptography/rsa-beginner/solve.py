from Crypto.Util.number import long_to_bytes

# Khóa công khai đã cho
n = 164844769  # Giá trị n đã được tính toán
e = 65537

# Đoạn mã đã được mã hóa
c = 55607878719  # Đoạn mã đã được tính toán

# Giải mã và chuyển đổi kết quả thành chuỗi bytes
plaintext = long_to_bytes(pow(c, e, n))

print("Nội dung đã được giải mã:")
print(plaintext.decode('utf-8'))
