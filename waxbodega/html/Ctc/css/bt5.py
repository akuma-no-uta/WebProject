# List of all possible truth values for p and q
propositions = [(True, True), (True, False), (False, True), (False, False)]
print("p | q | p AND q | p OR q | p → q")
print("--------------------------------------------")
cau1 = (p and q) or (not p and not q)
cau2 = (not p or q) and (not q or r)  or not ((not p or q) or (not q or r))\

print(f"{p:<5} | {q:<5} | {cau1} | {cau2} ") 

# List of all possible truth values for p and q
propositions = [(True, True), (True, False), (False, True), (False, False)]
print("p | q | p AND q | p OR q | p → q")
print("--------------------------------------------")
cau3b = p and not q
cau3a = not (not p or q) 

print(f"{p:<5} | {q:<5} | {cau3a} | {cau3b} ") 
if cau3b == cau3a:
    print("hai menh de tuong duong")
else:
    print(sai)

cau4a = not p or (q or r)
cau4b = not (p or not q) or r
print(f"{p:<5} | {q:<5} | {cau3a} | {cau3b} ") 
if cau4a == cau4b:
    print("hai menh de tuong duong")
else:
    print("sai")
