clearText = input("[!] Nhập tin nhắn muốn mã hóa: ")
displacement = int(input("[!] Nhập độ dời của ký tự: "))
cipher =  ""
for i in clearText:
    if ("a" <= i and i <= "z"):
        cipher += chr(ord('a') + ((ord(i) - ord('a') + displacement)%26)) 
        continue
    if ("A" <= i and i <= "Z"):
        cipher += chr(ord('A') + ((ord(i) - ord('A') + displacement)%26)) 
        continue
    cipher += i

print("[!] Bản mã: ")

for i in range(ord('a'), ord('z') + 1):
    print("%3s" % chr(i), end=" ")

print()
    
for i in range(ord('a'), ord('z') + 1):
    print("%3s" % chr(ord('a') + ((i - ord('a') + displacement)%26)), end=" ")
    
print()

print("[+] Tin nhắn sau khi mã hóa là: %s" % cipher)