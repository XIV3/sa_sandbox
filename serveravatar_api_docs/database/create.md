# Create

To create a database.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/databases
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| name | Yes | Alpha-Numeric | Name of the database. |
| username | Yes | String | Alpha-Numeric string, Minimum 5 characters. |
| password | Yes | String | Random string, Minimum 8 characters. |
| connection_preference | No | String | Select any one connection preference: `localhost`, `everywhere`, `specific_ip_addresses` | 
| hostname | No | Array | IPv4 address. Required if hostname is `specific_ip_addresses` and you want to enable remote access. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/databases" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "TestDatabase",
    "username": "DPF8dy2JkmgpzUQR",
    "password": "5QVBwaTM5uLTrUhg",
    "connection_preference": "specific_ip_addresses",
    "hostname": ["192.168.1.100", "192.168.1.101"]
  }'
```

### Response:

#### Database Create:
- __200__ (Ok)

```json
{
  "message": "Database has been created successfully!"
}
```

#### Duplicate Database
- __500__ (Internal Server Error)

```json
{
    "message": "Duplicate database name found!"
}
```

#### Duplicate Username
- __500__ (Internal Server Error)

```json
{
    "message": "Duplicate username detected!"
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
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}