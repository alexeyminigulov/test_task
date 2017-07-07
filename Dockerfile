FROM ubuntu:16.04

RUN apt-get update && apt-get install -y supervisor

ADD . /root

RUN mkdir -p /var/log/supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN bash /root/scripts/main.sh

RUN cd /var/www/site.ru && npm install \
	&& npm install gulp -g \
	&& composer install --no-plugins --no-scripts \
	&& npm run build

# Expose port 80 from the container to the host
EXPOSE 80

CMD ["/usr/bin/supervisord"]
