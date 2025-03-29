# Update

Update the specific cronjob schedule.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/cronjobs/{cronjob}
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| command | Yes | String | A command to execute in a cronjob. |
| schedule | Yes | String | The name of the cronjob preset or "custom" for custom scheduling. |
| minute | No | Numeric | Minute section of a cronjob schedule, if schedule is 'custom'. |
| hour | No | Numeric | Hour section of a cronjob schedule, if schedule is 'custom'. |
| month | No | Numeric | Month section of a cronjob schedule, if schedule is 'custom'. |
| day_of_week | No | Numeric | Day of a week section of a cronjob schedule, if schedule is 'custom'. |
| day_of_month | No | Numeric | Day of a month section of a cronjob schedule, if schedule is 'custom'. |
| system_user | Yes | String | Your application user. |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/cronjobs/63" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
  	"command": "sudo apt upgrade",
    "schedule": "custom",
    "minute": 45,
    "hour": 11,
    "month": 5,
    "day_of_week": 4,
    "day_of_month": 13,
    "system_user": "q9mStIMWR3r5HAzU"
  }'
```

### Response:

#### Cronjob Create
**200** (Ok)

```json
{
  "cronjob": {
    "id": 63,
    "server_id": 15,
    "name": "TestCronjob",
    "schedule": "45 11 4 13 5",
    "command": "sudo apt upgrade",
    "custom_scheduling": 1,
    "enabled": 1,
    "system_user": "q9mStIMWR3r5HAzU",
    "created_at": "2023-02-17 10:57:53",
    "updated_at": "2023-02-17 11:45:46"
  },
  "message": "Cronjob has been updated successfully!"
}
```

#### Cronjob not found
- __404__ (Not Found)

```json
{
    "message": "Cronjob not found!"
}
```

#### Organization not found
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

#### Invalid Schedule
- __500__ (Internal Server Error)

```json
{
    "message": "Invalid schedule!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```