# Auto Pull

Git deployment in Enable or Disable auto pull.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/webhook/{status:true,false}
```

### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/webhook/true" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Enable/Disable Auto pull

- __200__ (Ok)

``` json
{
  "message":"Git webhook enable successfully!"
}
```

#### Git Deployment Not Found
- __404__ (Not Found)

```json
{
    "message": "Git deployment not found!"
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