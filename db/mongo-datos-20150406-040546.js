
/** estudiantes indexes **/
db.getCollection("estudiantes").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** usuarios indexes **/
db.getCollection("usuarios").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** estudiantes records **/
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000042"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "CLAUDIA",
  "Ap_PATERNO": "GARCIA",
  "Ap_MATERNO": "CADIMA",
  "RUDE": "8097006620083216",
  "GENERO": "F",
  "CI": "12588232",
  "FECHA_NAC": ISODate("2000-03-27T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000043"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "CRISTHIAN",
  "Ap_PATERNO": "PANIAGUA",
  "Ap_MATERNO": "SANCHEZ",
  "RUDE": "80970070200867",
  "GENERO": "M",
  "CI": "9431749",
  "FECHA_NAC": ISODate("2002-04-04T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000044"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "DANIEL",
  "Ap_PATERNO": "CORDERO",
  "Ap_MATERNO": "NOVA",
  "RUDE": "80970033200835",
  "GENERO": "M",
  "CI": "9308980",
  "FECHA_NAC": ISODate("2002-07-14T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000045"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "DAVID",
  "Ap_PATERNO": "YUFRA",
  "Ap_MATERNO": "PEREZ",
  "RUDE": "80970008200770",
  "GENERO": "M",
  "CI": "9461588",
  "FECHA_NAC": ISODate("2003-01-11T00:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000046"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "DENILSON",
  "Ap_PATERNO": "VILLARROEL",
  "Ap_MATERNO": "CLAROS",
  "RUDE": "809700722008109",
  "GENERO": "M",
  "CI": "6527831",
  "FECHA_NAC": ISODate("2001-07-12T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000047"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "DEYSI",
  "Ap_PATERNO": "MAMANI",
  "Ap_MATERNO": "LIMA",
  "RUDE": "809700102007207",
  "GENERO": "F",
  "CI": "7519697",
  "FECHA_NAC": ISODate("2001-08-14T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000048"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "ELMER",
  "Ap_PATERNO": "JALDIN",
  "Ap_MATERNO": "RIOJA",
  "RUDE": "809700372007253",
  "GENERO": "M",
  "CI": "9449201",
  "FECHA_NAC": ISODate("2002-01-20T00:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000049"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "ELMER",
  "Ap_PATERNO": "SANCHEZ",
  "Ap_MATERNO": "DIAS",
  "RUDE": "809700582007207",
  "GENERO": "M",
  "CI": "9450369",
  "FECHA_NAC": ISODate("2001-05-09T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900004a"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "FELIX",
  "Ap_PATERNO": "QUINTEROS",
  "Ap_MATERNO": "NOVILLO",
  "RUDE": "809700742008251",
  "GENERO": "M",
  "CI": "9441242",
  "FECHA_NAC": ISODate("1998-09-24T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900004b"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "GILMAR",
  "Ap_PATERNO": "LOPEZ",
  "Ap_MATERNO": "MONTAÑO",
  "RUDE": "809700582007371",
  "GENERO": "M",
  "CI": "9450304",
  "FECHA_NAC": ISODate("2001-07-26T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900004c"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "GUADALUPE",
  "Ap_PATERNO": "TORRICO",
  "Ap_MATERNO": "SILES",
  "RUDE": "80970073200710308",
  "GENERO": "F",
  "CI": "7513903",
  "FECHA_NAC": ISODate("2001-09-09T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900004d"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "JACINTO",
  "Ap_PATERNO": "BARRIGA",
  "Ap_MATERNO": "BECERRA",
  "RUDE": "809700772008138",
  "GENERO": "M",
  "CI": "9370666",
  "FECHA_NAC": ISODate("2000-08-13T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900004e"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "JAMIL",
  "Ap_PATERNO": "ALVAREZ",
  "Ap_MATERNO": "RODRIGUEZ",
  "RUDE": "809700372007157",
  "GENERO": "M",
  "CI": "9449097",
  "FECHA_NAC": ISODate("2001-10-25T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900004f"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "JHANETH",
  "Ap_PATERNO": "BARBOLIN",
  "Ap_MATERNO": "BUSTAMANTE",
  "RUDE": "809700482007124",
  "GENERO": "F",
  "CI": "8858799",
  "FECHA_NAC": ISODate("2001-09-29T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900003b"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "ABIGAIL",
  "Ap_PATERNO": "GARCIA",
  "Ap_MATERNO": "SEJAS",
  "RUDE": "809700702008197",
  "GENERO": "F",
  "CI": "9431766",
  "FECHA_NAC": ISODate("2001-09-03T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900003c"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "AIDE",
  "Ap_PATERNO": "ANAGUA",
  "Ap_MATERNO": "SANCHEZ",
  "RUDE": "80480268200819",
  "GENERO": "F",
  "CI": "12917342",
  "FECHA_NAC": ISODate("2001-04-11T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900003d"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "ANA",
  "Ap_PATERNO": "ANDIA",
  "Ap_MATERNO": "MARISCAL",
  "RUDE": "808601532008134",
  "GENERO": "F",
  "CI": "9370632",
  "FECHA_NAC": ISODate("2001-04-25T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900003e"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "ANACLETO",
  "Ap_PATERNO": "CLAROS",
  "Ap_MATERNO": "SENZANO",
  "RUDE": "80970032200885",
  "GENERO": "M",
  "CI": "9331414",
  "FECHA_NAC": ISODate("2002-06-26T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d341900003f"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "ANALI",
  "Ap_PATERNO": null,
  "Ap_MATERNO": "RODRIGUEZ",
  "RUDE": "60890052200856",
  "GENERO": "F",
  "CI": "9449147",
  "FECHA_NAC": ISODate("2002-02-06T00:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000040"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "BISMARK",
  "Ap_PATERNO": "DELGADILLO",
  "Ap_MATERNO": "FERNANDEZ",
  "RUDE": "809700372007211",
  "GENERO": "M",
  "CI": "9449194",
  "FECHA_NAC": ISODate("2001-11-25T00:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});
db.getCollection("estudiantes").insert({
  "_id": ObjectId("55215e5912cb7d3419000041"),
  "DISTRITO_EDUCATIVO": "AIQUILE",
  "MATERIA": "matematica",
  "CURSO": "1s",
  "NOMBRE": "CARLOS DANIEL",
  "Ap_PATERNO": "TABOADA",
  "Ap_MATERNO": "ALMENDRAS",
  "RUDE": "80970074200820A",
  "GENERO": "M",
  "CI": "9332203",
  "FECHA_NAC": ISODate("2001-08-04T23:00:00.0Z"),
  "CORREO": null,
  "FONO": "0"
});

/** usuarios records **/
db.getCollection("usuarios").insert({
  "_id": ObjectId("5519fea012cb7d7408000029"),
  "nombre": "daniel",
  "apellido": "candia",
  "password": "12345",
  "rol": "admin",
  "username": "danfercf@gmail.com"
});
