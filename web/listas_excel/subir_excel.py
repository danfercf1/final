from pymongo import MongoClient
from datetime import datetime
import xlrd
from bson.objectid import ObjectId
import re
import random
import json
import numbers

__author__ = 'daniel candia'
client = MongoClient()
db = client.datos
print("1. Cargando Archivo")
with open('configuracion.json') as data_file:
    data = json.load(data_file)

archivo_subir = "archivos/"+data["archivo"]
gestion = data["gestion"]
etapas = data["etapas"]

book = xlrd.open_workbook(archivo_subir)

sheet = book.sheet_by_index(0)
dataEstudiante = {}
dataTutor = {}
dataUE = {}
cont = 0
cell = sheet.cell(0, 1)

print("2. Insertando Datos")

for i in range(1, sheet.nrows):
    cell = sheet.cell(i, 3)
    if cell.value == 'matematica':
        for j in range(1, sheet.ncols):
            cell = sheet.cell(i, j)
            tipo = sheet.cell_type(i, j)
            titulo = sheet.cell(0, j)
            titulo = titulo.value
            if tipo == xlrd.XL_CELL_TEXT:
                celda = cell.value.lower()
            elif tipo == xlrd.XL_CELL_DATE:
                celda = datetime(*xlrd.xldate_as_tuple(cell.value, book.datemode))
            elif tipo == xlrd.XL_CELL_TEXT:
                celda = re.escape(cell.value)
            else:
                celda = cell.value

            titulo = titulo.replace('.', '')

            titulo = titulo.replace(' ', '_')

            #ESTUDIANTE
            if(j <=14):
                dataEstudiante[titulo] = celda
            #TUTOR
            elif(j>=15 and j<=21):
                dataTutor[titulo] = celda
            #UE
            elif (j>=22 and j<=28):
                dataUE[titulo] = celda



        #TUTOR
        tutor_cell = sheet.cell(i, 19)
        tipo = sheet.cell_type(i, 19)
        tut_ci_valor = tutor_cell.value

        if tipo == xlrd.XL_CELL_NUMBER:
            tutor_ci = str(int(tutor_cell.value))
        else:
            tutor_ci = str(tutor_cell.value)

        dataTutor["CI_T"] = tutor_ci

        cursor_tutor = db.tutor.find_one({"CI_T": tutor_ci})

        if cursor_tutor is None:
            tutor_id = ObjectId()
            dataTutor['_id'] = tutor_id
            db.tutor.insert_one(dataTutor)
        else:
            tutor_id = cursor_tutor['_id']

        #UE

        ue_cell = sheet.cell(i, 22)

        ue_cod = ue_cell.value

        cursor_ue = db.ue.find_one({"COD_SIE": ue_cod})

        if cursor_ue is None:
            ue_id = ObjectId()
            dataUE['_id'] = ue_id
            db.ue.insert_one(dataUE)
        else:
            ue_id = cursor_ue['_id']

        dataEstudiante['_id'] = ObjectId()
        #Tutor
        dataEstudiante['TUTOR'] = ObjectId(tutor_id)
        #UE
        dataEstudiante['UNIDAD_EDUCATIVA'] = ObjectId(ue_id)

        #GESTION

        dataEstudiante["GESTION"] = gestion

        #ETAPAS
        for n in range(1, etapas+1):
            dataEstudiante["NOTA_ETAPA"+str(n)] = 0

        #NOTA
        #dataEstudiante['NOTA'] = random.randint(0, 100)

        estudiante = db.estudiante.insert_one(dataEstudiante)
        cont = cont+1

if(cont >= 1):
    print("3. Se agregaron: "+str(cont)+" datos")
else:
    print("3. No se agregaron datos")