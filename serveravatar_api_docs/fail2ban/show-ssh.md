# SSH Detail

Get the detail of the SSH Fail2ban.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/fail2ban
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/fail2ban" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### SSH Detail:

- __200__ (Ok)

```json
{
    "setting": {
        "id":22,
        "ban_time":"10m",
        "find_time":"10m",
        "max_retry":5
    }
}
```

#### Not Found
- __404__ (Not Found)

```json
{
    "message": "Record not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong."
}
```
