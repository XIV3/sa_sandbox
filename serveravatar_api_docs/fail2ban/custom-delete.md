# Custom Jail Disable For Application

Enable or disable SSH Fail2ban.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/fail2ban
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/fail2ban" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Custom Jail Disable:

- __200__ (Ok)

```json
{
    "message": "Fail2ban disabled successfully!"
}
```

#### Already Disabled:

- __500__ (Ok)

```json
{
    "message": "Fail2ban already disabled."
}
```

#### Record Not Found

- __404__ (Not Found)

```json
{
    "message": "Record not found!"
}
```

#### Server Error

- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while desabling fail2ban."
}
```
