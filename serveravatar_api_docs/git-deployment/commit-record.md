# Commit Record

Use this method to get a webhook history.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/commit-record
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/commit-record" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Commit Records

- __200__ (Ok)

``` json
{
    "gitCommits": {
        "current_page": 1,
        "data": [
            {
                "id": 17,
                "git_deployment_id": 21,
                "branch": "master",
                "commit_message": "test git3",
                "committer_name": "Akbari Krishna",
                "committer_email": "krishna@serveravatar.com",
                "pushed_at": "2023-02-20 05:28:10",
                "created_at": "2023-02-19 18:28:19",
                "updated_at": "2023-02-19 18:28:19",
                "scriptId": 10,
                "scriptStatus": "error"
            }
        ],
        "first_page_url": "https://api.serveravatar.com/organizations/5/servers/15/applications/85/git/commit-record?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/applications/85/git/commit-record?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/5/servers/15/applications/85/git/commit-record?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "https://api.serveravatar.com/organizations/5/servers/15/applications/85/git/commit-record",
        "per_page": 10,
        "prev_page_url": null,
        "to": 4,
        "total": 4
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