# SSH Update Config

Update config in SSH Fail2ban.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/fail2ban
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| max_retry | Yes | Numeric | Numeric value. |
| ban_time | Yes | String | Numeric with `m` required in value. |
| find_time | Yes | String | Numeric with `m` required in value. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/fail2ban" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
  --data '{
    "max_retry": 5,
    "ban_time": "10m",
    "find_time": "10m"
  }'
```

### Response:

#### Update SSH Jail Config:
- __200__ (Ok)

```json
{
    "message": "Fail2ban enabled successfully!"
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
    "message": "Something went really wrong while updating fail2ban."
}
```
