# Deployment Key

Use this method to generate a git deployment key.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/git/key
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/git/key" \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Git deployment ssh-key

- __200__ (Ok)

``` json
{
  "file_name": "DIptqU8hxNeyR1x5vZ3A7PqjoqCEvwkw",
  "git_public_key": "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQC9ycQMSrI9isiGU+0tIU0iNjIUT4HFjVUxbfak9JHrurkWR\/mLvEchlofwU3S2DiFE+Lg3gkiQbkTwXb8m8T7Q8JKeH\/f5jA5wv0VWjI2QSZm0CWtfK+Fgj+Qp3A6d1p2NtESHJzAoDqNLdBxfH4SDGaIjbTUvmhvVOoaAMsXN0APjOdpaGUxwWIgJSPZUU3RHv0UTYtsNWF7kAieTM63xuLrIU4nBY7TU0lxLi3lFcAvJYnfTPkNlIYq3gKTgQogOaQpLH6e7M2xxafaLm38WLFd\/oCRqAecvyb4mBk\/fxaf7gnGr\/idxXBHrFok7vHT\/0qk+lOrUEHVXVOfVJ+pD phpseclib-generated-key"
}
```

#### Organization Not found
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