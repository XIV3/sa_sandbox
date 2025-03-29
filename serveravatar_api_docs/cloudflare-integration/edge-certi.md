# Edge Certificate

## List

List of cloudflare edge-certificates.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/edge-certificate
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/edge-certificate" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### TLS Version

- __200__ (Ok)

``` json
{
    "certificate": [
        {
            "id": "97c0ee-840f-4594-af70-ff3a54381ec7",
            "type": "universal",
            "hosts": [
                "*.domain.com",
                "domain.com"
            ],
            "status": "active",
            "expires_on": "2022-09-19T23:59:59.000000Z"
        }
    ]
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not found
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

## Show

Show the detail of edge-certificate.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/edge-certificate/{certificateId}
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/dns-manager/ssl/edge-certificate/97c0ee-840f-4594-af70-ff3a54381ec7" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Edge Certificate

- __200__ (Ok)

``` json
{
    "response": {
        "id": "97c0ee-840f-4594-af70-ff3a54381ec7",
        "type": "universal",
        "hosts": [
            "*.domain.com",
            "domain.com"
        ],
        "status": "active",
        "expires_on": "2022-09-19T23:59:59.000000Z",
        "signature": "ECDSAWithSHA256",
        "validity_days": 365,
        "validation_method": "txt"
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

#### Application Not found
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
