# Presets

Get a list of preset cronjob schedules.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/cronjobs/presets
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/cronjobs/presets" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Presets Lists
- __200__ (Ok)

``` json
{
    "presets": {
        "everyMinute": "Every minute",
        "every5Minutes": "Every 5 minutes",
        "every10Minutes": "Every 10 minutes",
        "every15Minutes": "Every 15 minutes",
        "every30Minutes": "Every 30 minutes",
        "everyHour": "Every hour",
        "every3Hours": "Every 3 hours",
        "every6Hours": "Every 6 hours",
        "every12Hours": "Every 12 hours",
        "everyDay": "Everyday",
        "everyWeek": "Every week (on Sunday)",
        "everyMonth": "Every month"
    }
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