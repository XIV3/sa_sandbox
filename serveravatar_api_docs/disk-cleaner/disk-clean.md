# Disk Clean

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/disk-cleaner
```

### Parameters:

| parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| schedule | No | String | daily, weekly, monthly, 6months, yearly |
| auto_clean | Yes | Boolean | `true`, if you want to auto_clean. |
| tmp | Yes | Boolean | `true`, if you want to clean tmp. |
| access_log | Yes | Boolean | `true`, if you want to clean access_log. |
| error_log | Yes | Boolean | `true`, if you want to clean error_log. |
| logs | Yes | Boolean | `true`, if you want to clean logs. |
| journal_logs | Yes | Boolean | `true`, if you want to clean journal_logs. |


### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/14/disk-cleaner" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <Your API Token>' \
  --data '{
        "schedule": "weekly",
        "auto_clean": 1,
        "tmp": 1,
        "access_log": 0,
        "error_log": 1,
        "logs": 0,
        "journal_logs": 0
  }'
```

### Response:

- __200__ (Ok)
```json
{
    "message": "Disk Cleaned Successfully!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Server Not Found
- __404__ (Not Found)
```json
{
    "message": "Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while disk cleaner!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```