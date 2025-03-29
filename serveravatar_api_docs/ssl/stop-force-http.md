# Stop Force Http

Disable/stop 'http' to 'https' redirection

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/ssl/stop-force-https
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/ssl/stop-force-https" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Stop force Https Redirection
- __200__ (Ok)

``` json
{
  "message": "http to https redirection is now disabled!"
}
```

#### Http Detected
- __500__ (Internal Server Error)

```json
{
    "message": "Your application already http detected!"
}
```

#### SSL Install Check
- __500__ (Internal Server Error)

```json
{
    "message": "Application does not have SSL Certificate installed!"
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
```