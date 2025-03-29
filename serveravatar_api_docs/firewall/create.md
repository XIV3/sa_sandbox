# Create

Create a new firewall rule for the server.

### HTTP Request:
```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/firewall-rules
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| start_port | Yes | Numeric | Select Firewall Start Port Between 1 to 65534 on your server. |
| end_port | No | String | Firewall End port, If available select port between 1 to 65534 on your server. |
| traffic | Yes | String | `allow` or `deny` traffic. |
| protocol | Yes | String | Select any one protocol: `all`, `tcp` or `udp`. |
| ip | No | IP | IPv4 address, If available. |
| description | No | String | Briefly describe the purpose of the firewall rule. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/firewall-rules" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
        "start_port": 45,
        "end_port": 450,
        "traffic": "allow",
        "protocol": "udp",
        "ip": "207.148.86.87",
        "description": "Allow UDP traffic for testing"
  }'
```

### Response:

#### Firewall Create:

- __200__ (Ok)

```json
{
    "firewallRule": {
        "id": 166,
        "server_id": 15,
        "start_port": 45,
        "end_port": 450,
        "protocol": "udp",
        "traffic": 1,
        "ip": "207.148.86.87",
        "description": "Allow UDP traffic for testing",
        "created_at": "2025-01-26 13:24:08",
        "updated_at": "2025-01-26 13:24:08"
    },
    "message": "Rule has been successfully added to firewall!"
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

#### End Port Range Higher than Start Port
- __500__ (Internal Server Error)

```json
{
    "message": "Ending port of the range must be higher than the starting port."
}
```

#### End Port Range Specify TCP or UDP
- __500__ (Internal Server Error)

```json
{
    "message": "You must specify TCP or UDP protocol while specifying port ranges."
}
```

####  Firewall Not Enabled
- __500__ (Internal Server Error)

```json
{
    "message": "Firewall not enabled!"
}
```

#### Duplicate Firewall Rule
- __500__ (Internal Server Error)
```json
{
    "message": "The specified firewall rule already exists."
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went wrong!"
}