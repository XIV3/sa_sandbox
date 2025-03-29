# Branch

List of selected repository's branch.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/git-providers/{provider_id}/branches
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| provider | Yes | String | Select any one provider from bitbucket, github, or gitlab. |
| workspace_slug | No | String | Required, if provider is bitbucket. |
| repository_slug | No | String | Required, if provider is bitbucket. |
| username | No | String | Required, if provider is github. |
| repository_name | No | String | Required, if provider is github. |
| project_id | No | String | Required, if provider is gitlab. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/git-providers/8/branches" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "provider":"gitlab",
    "project_id":36680818
  }'
```

### Response:

#### Branch lists

- __200__ (Ok)

```json
{
  "gitBranches": [
    "test",
    "test-demo"
  ]
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Provider Not Found
- __404__ (Not Found)

```json
{
    "message": "Git Provider not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```