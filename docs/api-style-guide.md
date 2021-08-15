# Restful API Endpoint 命名

--- 
## Route Resource採用**複數**形式 
```
/api/questions
```

---  
## API Json格式

1. data存放resource資料
2. json key採用**小寫底線**
3. 有錯誤時，回傳message幫助釐清問題

200 OK (單數)
```
{
    "data": {
        "id": 1,
        "first_name": "Bear",
        "gender": "male",
    }
}
```

201 Created (複數)
```
{
    "data": [
        {
            "id": 1,
            "first_name": "Bear",
            "gender": "male",
        },
        {
            "id": 2,
            "first_name": "Cat",
            "gender": "female",
        },
    ]
}
```

401 Unauthorized
```
{
    "message": "User not found or incorrect password"
}
```

500 Internal Server Error
```
{
    "message": "Something went wrong",
}
```

--- 

待討論：API文件的撰寫
