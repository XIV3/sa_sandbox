# Actions

## Restart a Process

To Restart a Process.

### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}/restart
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}/restart" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
```

### Response:

#### Restarted a Process:
- __200__ (Ok)

```json
{
  "message": "Process EmailDefault has been restart Successfully."
}
```

## Start a Process

To Start a Process.

### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}/start
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}/start" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
```

### Response:

#### Started a Process:
- __200__ (Ok)

```json
{
  "message": "Process EmailDefault has been start Successfully."
}
```

## Stop a Process

To Stop a Process.

### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}/stop
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}/stop" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
```

### Response:

#### Stopped a Process:
- __200__ (Ok)

```json
{
  "message": "Process EmailDefault has been stop Successfully."
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