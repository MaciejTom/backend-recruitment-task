FROM php
COPY . ./
EXPOSE 1111
CMD ["php", "-S", "0.0.0.0:3000"]

