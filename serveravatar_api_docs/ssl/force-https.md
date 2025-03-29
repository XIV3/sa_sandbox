# Force Https redirection

Enable 'http' to 'https' redirection.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/ssl/force-https
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/ssl/force-https" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Force Http to Https Redirection
- __200__ (Ok)

``` json
{
  "message": "http to https redirection is now enabled!"
}
```

#### SSL Install Check
- __500__ (Internal Server Error)

```json
{
    "message": "Application does not have SSL Certificate installed!"
}
```

#### Already Enabled Http to Https
- __500__ (Internal Server Error)

```json
{
    "message": "Already enabled http to https redirection!"
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