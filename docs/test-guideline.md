# 測試指引

## 資料夾結構

```
/Feature
    /Acceptance（驗收測試：多個 api 配合的測試）
    /Api（Api 測試：測試單個 api ）
    /App（整合測試）
        /Http
        /Services...

/Unit（單元測試）
    /App
        /Http
        /Services...
```

整合測試及單元測試內的資料夾結構遵循 ```app``` 資料夾內結構
