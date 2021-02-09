import socket
import pymysql
import mysql.connector

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.bind(('localhost', 5000))
s.listen(5)

def query():
    miConexion = mysql.connector.connect(host="localhost", user="root", passwd="", db="tracemail")
    cur = miConexion.cursor()
    cur.execute("SELECT Specification FROM Documents")
    for DocId in cur.fetchall():
        print(DocId[0])
    miConexion.close()


def establish_connection():
    while True:
        clientsocket, address = s.accept()
        print(f"Connection from {address} has been established")
        msg = clientsocket.recv(1024)
        msg = msg.decode("utf-8")
        msg = list(msg)
        msg = msg[2::]
        msg = ''.join(msg)
        print(msg)

def send_socket_msg(msg):
        clientsocket.send(bytes(msg))


query()