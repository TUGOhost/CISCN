FROM centos:centos7
MAINTAINER DXkite dxkite(at)gmail

RUN yum install -y net-tools 

# get xampp
RUN curl -o xampp-linux-installer.run "https://downloadsapachefriends.global.ssl.fastly.net/xampp-files/7.2.5/xampp-linux-x64-7.2.5-0-installer.run?from_af=true"

# install xampp
RUN chmod +x xampp-linux-installer.run
RUN bash -c './xampp-linux-installer.run'
RUN ln -sf /opt/lampp/lampp /usr/bin/lampp



# copy files

RUN mkdir /sshop
COPY ./app /sshop
RUN sed -i 's/\/opt\/lampp\/htdocs/\/sshop/g' /opt/lampp/etc/httpd.conf
RUN lampp startmysql
RUN /opt/lampp/bin/mysql -h localhost -u root -p   < /sshoop/ciscn.sql



# setup config
RUN echo '/opt/lampp/lampp startapache' >> /start.sh
RUN echo '/opt/lampp/lampp startmysql' >> /start.sh
EXPOSE 80
