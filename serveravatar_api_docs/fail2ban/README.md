# SSH

Enable or disable SSH Fail2ban.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/fail2ban
```

### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/fail2ban" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Enable/Disable:
- __200__ (Ok)

```json
{
    "message": "Fail2ban enabled successfully!"
}
```

#### Record Not Found:
- __404__ (Not Found)

```json
{
    "message": "Record not found!"
}
```

#### Server Error:
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while updating fail2ban."
}
```
