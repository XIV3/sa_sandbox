# Presets schedules

Get a list of the preset scheduled time.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/backups/presets
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/backups/presets" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Presets Lists
- __200__ (Ok)

``` json
{
    "databases": null,
    "schedules": [
        "Every Hour",
        "Every 3 Hours",
        "Every 6 Hours",
        "Every 12 Hours",
        "Every Day",
        "Every 2 Days",
        "Every Week",
        "Every Month",
        "Twice a Month",
        "Every 3 Months",
        "Every 6 Months",
        "Every Year"
    ],
    "retentionPeriod": [
        "1 Month",
        "2 Months",
        "3 Months",
        "6 Months",
        "12 Months",
        "24 Months"
    ],
    "selectedDatabase": null
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Server not found
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
    "message":"Something went really wrong!"
}
```