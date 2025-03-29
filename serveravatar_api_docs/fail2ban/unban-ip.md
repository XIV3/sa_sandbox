# Unban Ip

Unban Ip in Jail.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/fail2ban/{fail2ban}/unban-ip
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| ip | Yes | IP | Any Ipv4 or Ipv6 ip address. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/fail2ban/11/unban-ip" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
  --data '{
    "ip": "254.244.84.16"
  }'
```

### Response:

#### Unban Ip:
- __200__ (Ok)

```json
{
    "message": "Ip unban successfully!"
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
    "message": "Something went really wrong."
}
```
