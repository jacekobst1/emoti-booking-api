## Emoti Booking API

### How to start?
1. Clone .env.example to .env
2. Optional: configure DB_DATABASE, DB_USERNAME and DB_PASSWORD in .env to your liking
3. Run `vendor/bin/sail up -d`
4. Run `vendor/bin/sail composer install`
5. Run `vendor/bin/sail artisan key:generate`
6. Run `vendor/bin/sail artisan migrate --seed`
7. Add new entry in _/etc/hosts_: `127.0.0.1 emoti-booking-api.test`
8. Try it: [http://emoti-booking-api.test/api/documentation](http://emoti-booking-api.test/api/documentation) 🙂
