# Clone

Get a clone from git provider.

### HTTP Request:

```js
POST https://api.serveravatar.com/git-deployment/server/{serverId}/application/{applicationId}/clone
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| type | Yes | String | Select any one private or public. |
| file_name | No | String | Required, if type is private. Use file_name value from generate ssh-key api response. | 
| provider | Yes | String | Select any one provider from bitbucket, github, or gitlab. |
| git_provider_id | No | Numeric | Selected Provider's account id |
| workspace_slug | No | String | Required, if type is private and provider is bitbucket. |
| repository_slug | No | String | Required, if type is private and provider is bitbucket. |
| username | No | String | Required, if type is private and provider is github. |
| repository_name | No | String | Required, if type is private and provider is github. |
| project_id | No | String | Required, if type is private and provider is gitlab. |
| repository | No | String | Required, if type is private. Selected repository. |
| clone_url | No | String | Required, if type is public. Clone url name. |
| branch | Yes | String | Selected branch. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/git-deployment/server/623/application/724/clone" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "type":"private",
    "file_name":"oQUmjZjxc51B1Hyzk9xPhyjTOtWcRIXw",
    "provider":"github",
    "repository":"username/laravel-test",
    "repository_name":"laravel-test",
    "branch":"master",
    "username":"username"
    }'
```

### Response:

#### Git Clone

- __200__ (Ok)

```json
{
  "gitDeploymentId": 25,
  "message": "Git deployment process has been started!"
}
```

#### Forbidden
- __403__ (Forbidden)

```json
{
    "message": "You can not perform this action!"
}
```

#### Another Process Running
- __500__ (Internal Server Error)
```json
{
    "message": "Please wait another git deployment process already running!"
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
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