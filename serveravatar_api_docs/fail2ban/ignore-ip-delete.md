# Remove Ignore Ip

Remove Ignore Ip in Jail.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/fail2ban/{fail2ban}/remove-ignore-ip
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| ip | Yes | IP | Any Ipv4 or Ipv6 ip address. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/fail2ban/11/remove-ignore-ip" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
  --data '{
    "ip": "114.70.185.87"
  }'
```

### Response:

#### Remove Ignore Ip:
- __200__ (Ok)

```json
{
    "message": "Ignore ip removed successfully!"
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
