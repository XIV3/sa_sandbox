# Destroy

Delete the firewall rule. note that server start allowing/denying traffic on the port once the rule is deleted.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/firewall-rules/{firewall}
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/5/servers/15/firewall-rules/869" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Firewall Rule Delete
- __200__ (Ok)

```json
{
    "message": "Rule has been successfully removed."
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

#### Firewall Not Found
- __404__ (Not Found)

```json
{
    "message": "Firewall not found!"
}
```

#### Invalid Port
- __500__ (Internal Server Error)

```json
{
    "message": "You can not close this port!"
}
```

#### Firewall Not Enabled
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
    "message": "Something went wrong while deleting rule."
}
```