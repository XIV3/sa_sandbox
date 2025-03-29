# Repository

Use this method to get a list of selected git provider account's repository.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/git-providers/{provider_id}/repositories
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/git-providers/8/repositories" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Gitlab provider's repository List

- __200__ (Ok)

``` json
{
  "gitRepositories": [
    {
      "project_id": 1111111,
      "repository_fullname": "username\/demoproject"
    },
    {
      "project_id": 1112222,
      "repository_fullname": "username\/gitlabprovider"
    }
  ]
}
```

#### Bitbucket provider's repository List

- __200__ (Ok)

``` json
{
  "gitRepositories": [
    {
      "repository_id": "{438abff1-782e-4b67-a156-68c60156dad8}",
      "repository_fullname": "username\/serveravatar-project",
      "workspace_slug": "serveravatar",
      "repository_slug": "serveravatar-test"
    },
    {
      "repository_id": "{dbb48996-ca7d-4904-8d32-e6e6c8795cd4}",
      "repository_fullname": "username\/laravel-project",
      "workspace_slug": "laravel",
      "repository_slug": "laravel-test"
    }
  ]
}
```

#### Github provider's repository List

- __200__ (Ok)

``` json
{
  "gitRepositories": [
    {
      "repository_id": 459111152,
      "username": "username",
      "repository_fullname": "username\/laravel-test",
      "repository_name": "laravel-test"
    },
    {
      "repository_id": 459111567,
      "username": "username",
      "repository_fullname": "username\/test",
      "repository_name": "test"
    }
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