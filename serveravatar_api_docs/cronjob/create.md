# Create

Create a new cronjob schedule for the server.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/cronjobs
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| name | Yes | Alpha-Numeric | The name of your cronjob. |
| command | Yes | String | A command to execute in a cronjob. |
| schedule | Yes | String | The name of the cronjob preset: `everyMinute`, `every5Minutes`, `every10Minutes`, `every15Minutes`, `every30Minutes`, `everyHour`, `every3Hours`, `every6Hours`, `every12Hours`, `everyDay`, `everyWeek`, `everyMonth`, or `custom` for custom scheduling. |
| minute | No | Numeric | Minute section of a cronjob schedule, if schedule is `custom` |
| hour | No | Numeric | Hour section of a cronjob schedule, if schedule is `custom` |
| month | No | Numeric | Month section of a cronjob schedule, if schedule is `custom` |
| day_of_week | No | Numeric | Day of a week section of a cronjob schedule, if schedule is `custom` |
| day_of_month | No | Numeric | Day of a month section of a cronjob schedule, if schedule is `custom` |
| system_user | Yes | String | Your application user. |

### Curl Request example:

#### Preset Schedule
```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/cronjobs" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "TestCronjob",
    "schedule": "everyDay",
    "command": "sudo apt-get update",
    "system_user": "q9mStIMWR3r5HAzU"
  }'
```

#### Custom Schedule
```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/cronjobs" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "TestCronjob",
    "schedule": "custom",
    "command": "cat << Hello",
    "minute": 5,
    "hour": 1,
    "month": 5,
    "day_of_week": 2,
    "day_of_month": 4
  }'
```

### Response:

#### Cronjob Created
**200** (Ok)

```json
{
  "cronjob": {
    "id": 63,
    "server_id": 15,
    "name": "TestCronjob",
    "schedule": "0 0 * * *",
    "command": "sudo apt-get update",
    "custom_scheduling": "0",
    "enabled": 1,
    "system_user": "q9mStIMWR3r5HAzU",
    "created_at": "2020-02-17 10:56:36",
    "updated_at": "2020-02-17 10:56:36"
  },
  "message": "Cronjob was successfully created on the server!"
}
```

#### Duplicate Cronjob File Name
- __500__ (Internal Server Error)
```json
{
    "message": "Duplicate file name found!"
}
```

#### Invalid Data
- __500__ (Internal Server Error)
```json
{
    "message": "Invalid schedule!"
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
```