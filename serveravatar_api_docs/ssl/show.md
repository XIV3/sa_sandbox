# Show

Get complete detail of the installed SSL certificate.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/ssl
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/ssl" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### SSL Certificate Detail
- __200__ (Ok)

``` json
{
    "installed": true,
    "forceHttps": 0,
    "certificateInfo": {
        "issuer": "(STAGING) Artificial Apricot R3",
        "primary_domain": "*.serveravatarfm.host",
        "domains": [
            "*.serveravatarfm.host"
        ],
        "issued_on": "2023-01-27 21:48:17",
        "expires_on": "2023-04-27 21:48:16",
        "is_expired": false,
        "validity_left": 57,
        "type": "custom",
        "temp_domain": 1
    }
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
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
    "message": "Something went really wrong!"
}