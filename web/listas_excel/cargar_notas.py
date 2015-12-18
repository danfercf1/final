from pymongo import MongoClient
import xlrd
import bson
import re

__author__ = 'daniel candia'
client = MongoClient()
db = client.datos
print("1. Cargando Excel")

#
# AGREGRAR LOS PARAMETROS CORRECTOS PARA CARGAR NOTAS A UNA LISTA ESPECIFICA DE ESTUDIANTES
#

archivo_subir = "archivos/clasificados 3ra etapa-actualizado.xlsx"

etapa = 2

gestion = 2015

id_evento = '56735e1a99b36c498012748b'

#FIN PARAMETROS

book = xlrd.open_workbook(archivo_subir)

sheet = book.sheet_by_index(0)
dataEstudiante = {}

cont = 0
cell = sheet.cell(0, 1)

print("2. Insertando Datos")

for i in range(1, sheet.nrows):
    cell = sheet.cell(i, 3)
    cell_rude = sheet.cell(i, 5)
    cell_nota = sheet.cell(i, 10)
    if cell.value == 'matematica':

        dataEstudiante['NOTA_ETAPA'+str(etapa)] = int(cell_nota.value)

        cursor_es = db.estudiante.find_one({"RUDE": re.compile(str(cell_rude.value), re.IGNORECASE), "GESTION": gestion, "NOMBRE_EVENTO": bson.objectid.ObjectId(id_evento)})

        if cursor_es is not None:
            estudiante = db.estudiante.update({'RUDE': re.compile(str(cell_rude.value), re.IGNORECASE), 'GESTION': gestion, 'NOMBRE_EVENTO': bson.objectid.ObjectId(id_evento)}, {"$set": dataEstudiante})
            cont = cont+1
        else:
            if cell_rude.value is None:
                print('No RUDE')
            else:
                print(cell_rude.value)

if(cont >= 1):
    print("3. Se agregaron: "+str(cont)+" datos")
else:
    print("3. No se agregaron datos")