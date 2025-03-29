# Toggle the firewall

Enable or disable the firewall.


### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/firewall
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/firewall" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Firewall Update
- __200__ (Ok)

``` json
{
  "message": "Firewall has been enabled successfully!"
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
__500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```