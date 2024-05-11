## Emoti Booking API

### How to start?

1. Clone .env.example to .env and .env.testing
2. Change DB_DATABASE in .env.testing to _testing_
3. Optional: configure DB_DATABASE, DB_USERNAME and DB_PASSWORD in .env to your liking
4. Run `vendor/bin/sail up -d`
5. Run `vendor/bin/sail composer install`
6. Run `vendor/bin/sail artisan key:generate`
7. Run `vendor/bin/sail artisan migrate --seed`
8. Add new entry in _/etc/hosts_: `127.0.0.1 emoti-booking-api.test`
9. Try it: [http://emoti-booking-api.test/api/documentation](http://emoti-booking-api.test/api/documentation) 🙂
