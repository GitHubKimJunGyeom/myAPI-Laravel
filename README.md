### preparation
```
git clone https://github.com/GitHubKimJunGyeom/myAPI.git
```

### Laravel
```
sail up
sail artisan migrate
sail artisan migrate --path=database/migrations/myAPI 
sail artisan migrate --database=logandlist
sail artisan migrate --path=database/migrations/LogAndList
```

### Vue
```
npm run generate
npm run dev
```

### Testing
```
sail artisan migrate --env=testing
sail artisan migrate --env=testing --path=database/migrations/myAPI
sail artisan migrate --env=testing --database=logandlist
sail artisan migrate --env=testing --path=database/migrations/LogAndList
sail test
```
