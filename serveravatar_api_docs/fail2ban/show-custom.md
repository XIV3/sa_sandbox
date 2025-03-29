# Custom Jail Detail For Application

Get Custom Jail Detail For Application.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/fail2ban/
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/fail2ban" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Custom Jail Detail:

- __200__ (Ok)

```json
{
    "fail2ban": {
        "id": 20,
        "jail_name": "testfail"
    },
    "jail_template": "enabled = true\n\n# Caution: Please refrain from modifying this line as it could potentially lead to server instability.\nfilter = testfail\n\nlogpath = \/home\/ldvc7WUkESHufGCt\/testfail\/logs\/access*log\nmaxretry = 3\nbantime = 3600\nfindtime = 600\nport = http.https\n",
    "filter_template": "failregex = ^&lt;HOST&gt; .* &quot;POST .*wp-login.php\n            ^&lt;HOST&gt; .* &quot;POST .*xmlrpc.php\n\nignoreregex =\n"
}
```

#### Record Not Found
- __404__ (Not Found)

```json
{
    "message": "Record not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while getting fail2ban."
}
```
