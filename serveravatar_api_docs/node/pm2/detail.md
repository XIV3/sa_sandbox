# Detail

Retrieve pm2 details for a specific SSR Node application on a Node Stack server.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/node-deployment/pm2-detail
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/1/servers/13/applications/223/node-deployment/pm2-detail" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### PM2 Detail
- __200__ (Ok)

``` json
{
    "pm2Detail": {
        "pid": 181275,
        "name": "testnewdomain",
        "status": "online",
        "memory": 131.444736,
        "cpu": 0,
        "uptime": "0 days, 0 hours, 0 minutes"
    }
}
```

#### Node Deployment Not Found
- __404__ (Not Found)

```json
{
    "message": "Node deployment not found for the application."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```