# Alerts

## List Alerts

list all alerts.

### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/alert
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/alert" \
  --header 'Accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Server Alerts List
- __200__ (Ok)

``` json
{
  "server_load": 100,
  "memory_usage": 80,
  "disk_usage": 90,
  "server_load_five_minute": 1.3,
  "server_load_fifteen_minute": 1.1
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
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

## Update Alerts

Update the alert.

### HTTP Request:

```
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/alert
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| server_load | Yes | Numeric | Enter server load. |
| memory_usage | Yes | Numeric | Enter memory usage. |
| disk_usage | Yes | Numeric | Enter disk usage. |
| server_load_five_minute | No | Numeric | Required, If server plan is Pro. |
| server_load_fifteen_minute | No | Numeric | Required, If server plan is Pro. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/alert" \
  --header 'content-type: application/json' \
  --header 'Accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "disk_usage": 90,
      "memory_usage": 80,
      "server_load": 100,
      "server_load_fifteen_minute": 8.1,
      "server_load_five_minute": 8.3,
  }'
```

### Response:

#### Server Logs List
- __200__ (Ok)

``` json
{
  "message": "Server alert successfully updated."
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