# Ban or Ignore Ips List

Get Ban or Ignore Ips List.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/fail2ban/{fail2ban}/{type:['ban','ignore']}/ips
```

### Curl Request example(Ban Ips):

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/fail2ban/11/ban/ips" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Curl Request example(Ignore Ips):

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/fail2ban/11/ignore/ips" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Ips (Ban or Ignore) List:
- __200__ (Ok)

```json
{
    "ips": [
        "254.244.84.16",
        "114.70.185.87",
        "56.132.179.110",
        "7.141.147.216"
    ]
}
```

#### Record Not Found
- __404__ (Not Found)

```json
{
    "message": "Record not found!"
}
```
#### Invalid Request
- __500__ (Internal Server Error)
```json
{
    "message": "Invalid request!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while getting {type:['ban','ignore']} ips."
}
```
