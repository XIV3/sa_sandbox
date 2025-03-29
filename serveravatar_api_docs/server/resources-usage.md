# Resources Usage

Get the disc usage of the server.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/usage
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/usage" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Resources Usage
- __200__ (Ok)

``` json
{
  "disk": {
    "total": 19.32,
    "usage_in_percentage": 28.11,
    "usage": 5.43
  },
  "memory": {
    "total": 0.46,
    "available": 0.24
  },
  "serverLoad": 0,
  "cores": 1,
  "swapMemory": {
    "total": 2,
    "available": 1.86
  },
  "serverUptime": "up 1 day, 1 hour, 28 minutes",
  "serverInfo": {
    "nodeVersion": "v16.19.1",
    "npmVersion": "8.19.3",
    "processor": "Intel(R) Xeon(R) CPU E5-2676 v3 @ 2.40GHz",
    "timezone": "Etc\/UTC",
    "restartRequired": "true"
  }
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
}
```

#### Processor Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong while getting cpu info!"
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
```