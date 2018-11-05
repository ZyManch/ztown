object Form1: TForm1
  Left = 192
  Top = 124
  Width = 870
  Height = 500
  Caption = 'Form1'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object PageControl1: TPageControl
    Left = 0
    Top = 0
    Width = 854
    Height = 462
    ActivePage = TabSheet1
    Align = alClient
    TabOrder = 0
    object TabSheet1: TTabSheet
      Caption = #1055#1086#1079#1080#1094#1080#1103
      object GroupBox1: TGroupBox
        Left = 16
        Top = 16
        Width = 321
        Height = 105
        Caption = #1056#1072#1079#1084#1077#1088' '#1090#1072#1081#1083#1086#1074
        TabOrder = 0
        object Label1: TLabel
          Left = 168
          Top = 24
          Width = 39
          Height = 13
          Caption = #1064#1080#1088#1080#1085#1072
        end
        object Label2: TLabel
          Left = 176
          Top = 48
          Width = 38
          Height = 13
          Caption = #1042#1099#1089#1086#1090#1072
        end
        object Label3: TLabel
          Left = 168
          Top = 72
          Width = 73
          Height = 13
          Caption = #1056#1072#1079#1084#1077#1088' '#1082#1072#1088#1090#1099
        end
        object Edit1: TEdit
          Left = 32
          Top = 24
          Width = 121
          Height = 21
          TabOrder = 0
          Text = '92'
        end
        object Edit2: TEdit
          Left = 32
          Top = 48
          Width = 121
          Height = 21
          TabOrder = 1
          Text = '48'
        end
        object Edit3: TEdit
          Left = 32
          Top = 72
          Width = 121
          Height = 21
          TabOrder = 2
          Text = '7'
        end
      end
      object GroupBox2: TGroupBox
        Left = 16
        Top = 128
        Width = 321
        Height = 209
        Caption = #1064#1072#1073#1083#1086#1085
        TabOrder = 1
        object Memo1: TMemo
          Left = 16
          Top = 32
          Width = 281
          Height = 161
          Lines.Strings = (
            '.item{X}_{Y}{'
            #9'position:absolute;'
            #9'left:{left}px;'
            #9'top:{top}px;'
            '}')
          TabOrder = 0
        end
      end
      object GroupBox3: TGroupBox
        Left = 344
        Top = 16
        Width = 473
        Height = 321
        Caption = #1056#1072#1089#1095#1077#1090
        TabOrder = 2
        object Button1: TButton
          Left = 16
          Top = 16
          Width = 75
          Height = 25
          Caption = #1057#1095#1080#1090#1072#1090#1100
          TabOrder = 0
          OnClick = Button1Click
        end
        object Memo2: TMemo
          Left = 16
          Top = 48
          Width = 449
          Height = 257
          Lines.Strings = (
            'Memo2')
          ScrollBars = ssVertical
          TabOrder = 1
        end
      end
      object ProgressBar1: TProgressBar
        Left = 16
        Top = 344
        Width = 801
        Height = 25
        TabOrder = 3
      end
    end
    object TabSheet2: TTabSheet
      Caption = #1056#1072#1079#1084#1077#1088#1099
      ImageIndex = 1
      object GroupBox4: TGroupBox
        Left = 16
        Top = 16
        Width = 321
        Height = 105
        Caption = #1056#1072#1079#1084#1077#1088' '#1090#1072#1081#1083#1086#1074
        TabOrder = 0
        object Label4: TLabel
          Left = 168
          Top = 24
          Width = 39
          Height = 13
          Caption = #1064#1080#1088#1080#1085#1072
        end
        object Label5: TLabel
          Left = 176
          Top = 48
          Width = 38
          Height = 13
          Caption = #1042#1099#1089#1086#1090#1072
        end
        object Label6: TLabel
          Left = 168
          Top = 72
          Width = 73
          Height = 13
          Caption = #1056#1072#1079#1084#1077#1088' '#1082#1072#1088#1090#1099
        end
        object Edit4: TEdit
          Left = 32
          Top = 24
          Width = 121
          Height = 21
          TabOrder = 0
          Text = '92'
        end
        object Edit5: TEdit
          Left = 32
          Top = 48
          Width = 121
          Height = 21
          TabOrder = 1
          Text = '48'
        end
        object Edit6: TEdit
          Left = 32
          Top = 72
          Width = 121
          Height = 21
          TabOrder = 2
          Text = '7'
        end
      end
      object GroupBox5: TGroupBox
        Left = 16
        Top = 128
        Width = 321
        Height = 209
        Caption = #1064#1072#1073#1083#1086#1085
        TabOrder = 1
        object Memo3: TMemo
          Left = 16
          Top = 32
          Width = 281
          Height = 161
          Lines.Strings = (
            '.tile{ID}{'
            #9'position:relative;'
            #9'left:{left}px;'
            #9'top:{top}px;'
            '}')
          TabOrder = 0
        end
      end
      object GroupBox6: TGroupBox
        Left = 344
        Top = 16
        Width = 473
        Height = 321
        Caption = #1056#1072#1089#1095#1077#1090
        TabOrder = 2
        object Button2: TButton
          Left = 16
          Top = 16
          Width = 75
          Height = 25
          Caption = #1057#1095#1080#1090#1072#1090#1100
          TabOrder = 0
          OnClick = Button2Click
        end
        object Memo4: TMemo
          Left = 16
          Top = 48
          Width = 449
          Height = 257
          Lines.Strings = (
            'Memo2')
          ScrollBars = ssVertical
          TabOrder = 1
        end
      end
      object ProgressBar2: TProgressBar
        Left = 48
        Top = 360
        Width = 673
        Height = 17
        TabOrder = 3
      end
    end
  end
end
