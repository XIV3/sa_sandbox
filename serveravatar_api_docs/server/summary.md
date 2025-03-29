# Summary

Get the short data summary of the server.


### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/summary
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/summary" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Server Summary
- __200__ (Ok)

``` json
{
  "summary": {
    "system_users": 0,
    "applications": 0,
    "databases": 0,
    "cronjobs": 0
  }
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
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