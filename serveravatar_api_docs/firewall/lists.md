# List

Get a list of firewall rules.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/firewall-rules
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/firewall-rules" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Firewall Rule List
- __200__ (Ok)

``` json
{
   "firewallRules": {
        "data": [
            {
                "id": 1446,
                "server_id": 1486,
                "start_port": 22,
                "end_port": null,
                "protocol": "all",
                "traffic": 1,
                "ip": null,
                "description": "Secure server access for management.",
                "created_at": "2025-01-27 16:19:57",
                "updated_at": "2025-01-27 16:19:57"
            },
            {
                "id": 1447,
                "server_id": 1486,
                "start_port": 80,
                "end_port": null,
                "protocol": "all",
                "traffic": 1,
                "ip": null,
                "description": "Unencrypted website traffic.",
                "created_at": "2025-01-27 16:19:57",
                "updated_at": "2025-01-27 16:19:57"
            },
            {
                "id": 1448,
                "server_id": 1486,
                "start_port": 443,
                "end_port": null,
                "protocol": "all",
                "traffic": 1,
                "ip": null,
                "description": "Encrypted website traffic.",
                "created_at": "2025-01-27 16:19:57",
                "updated_at": "2025-01-27 16:19:57"
            },
            {
                "id": 1449,
                "server_id": 1486,
                "start_port": 43210,
                "end_port": null,
                "protocol": "all",
                "traffic": 1,
                "ip": null,
                "description": "Used by ServerAvatar for internal operations.",
                "created_at": "2025-01-27 16:19:57",
                "updated_at": "2025-01-27 16:19:57"
            }
        ],
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

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Firewall Not Enable
- __500__ (Internal Server Error)

```json
{
    "message": "Please enable firewall to list rules!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```